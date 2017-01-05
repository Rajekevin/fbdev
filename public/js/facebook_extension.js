/**
 * @author                 Didier Youn <didier.youn@gmail.com>
 * @copyright              Copyright (c) 2016 Did Youn
 * @link                   http://www.didier-youn.com
 */
var FacebookApiExtension = function () {
    /** Init variables used in the module helper */
    var $j = jQuery.noConflict();
    /**
     * CSRF TOKEN need for ajax call
     */
    var CSRF_TOKEN = $j('meta[name="csrf-token"]').attr('content');
    /**
     * Class used as button identifier
     * @type {string}
     */
    var CLASS_BUTTON_ADD_LIKE = '.btn-like';
    var CLASS_BUTTON_ADD_SHARE = '.btn-share';
    var CLASS_BUTTON_ADD_VOTE = '.btn-vote';
    var CLASS_BUTTON_FILTER_LIKE = '.btn-filter-like';
    var CLASS_BUTTON_FILTER_NEWEST = '.btn-filter-newest';
    var CLASS_BUTTON_FILTER_ALPHABETICAL = '.btn-filter-alphabetical';

    /**
     * Mapping of actions and AJAX routes used
     *
     * @type {{like: string, share: string, picture: string}}
     */
    var PATH_ACTIONS = {
        'action' : {
            'routes' : {
                'like': '/xhr/add/like',
                'share': '/xhr/add/share',
                'vote': '/xhr/add/vote'
            },
            'method' : 'POST'
        },
        'sort' : {
            'routes' : {
                'by-like' : '/xhr/contest/likest',
                'by-newest' : '/xhr/contest/newest',
                'by-alphabetical' : '/xhr/contest/alphabetical'
            },
            'method' : 'GET'
        }
    };

    /**
     * All the method used this method as XML Request transport
     *
     * @method {private}
     * @param option
     * @param callback
     * @return callback
     */
    var send = function(option, callback) {
        $j.ajax({
            url : option.url,
            headers : {
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            method : option.method || 'GET',
            data : option.data || null,
            beforeSend : beforeSend,
            success : function (response) {
                callback(response);
            }
        })
    };

    /**
     * Update FO when AJAX call is still running
     * @TODO : Faire le loader si besoin
     */
    var beforeSend = function() {
        console.log('Ajax start...');
    };

    /**
     * Get data of target element need to send as object
     *
     * @param {object} element
     * @param {object} context
     */
    var getContextData = function(element, context) {
        var contextKey = Object.keys(context)[0],
            contextValue = context[contextKey],
            data = {};

        switch (contextKey) {
            case 'action' :
                var parent = element.closest('.image_container'),
                    elementId = parent.attr('data-id'),
                    pattern = '^[a-zA-Z]*-(\\d*)$',
                    regex = new RegExp(pattern, 'g'),
                    matches = regex.exec(elementId);

                data.id = parseInt(matches[1]);
                break;
            case 'sort' :
                break;
            default :
                return false;
        };

        return {
            url : PATH_ACTIONS[contextKey]['routes'][contextValue],
            method : PATH_ACTIONS[contextKey]['method'],
            data : data
        }
    };

    /**
     * Before each action, prepared an object for AJAX and launch them
     *
     * @param {object} e
     * @return {boolean}
     */
    var beforeAction = function(e) {
        var target = $j(e.target),
            options = getContextData(target, e.data);
        if (!options) {
            return false;
        }
        send(options, function(response) {
            afterAction(response);
        });
    };

    /**
     * After each actions
     *
     * @param response
     * @return {boolean}
     */
    var afterAction = function(response) {
        var response = JSON.parse(response);
        if (response.error === false) {
            console.log('Ajax finish');
            return true;
        }
        if (typeof response.error.login !== 'undefined') {
            var link = document.createElement('a');
            link.href = response.error.login;
            document.body.appendChild(link);
            link.click();
        }
    };

    var beforeParticipate = function () {

    };

    /**
     * Initialize the observers on button action
     *
     * @method {public}
     */
    var initialize = function () {
        $j(CLASS_BUTTON_ADD_LIKE).bind('click', { action : 'like'}, beforeAction);
        $j(CLASS_BUTTON_ADD_SHARE).bind('click', { action : 'share'}, beforeAction);
        $j(CLASS_BUTTON_ADD_VOTE).bind('click', { action : 'vote'}, beforeAction);

        $j(CLASS_BUTTON_FILTER_LIKE).bind('click', { sort : 'by-like'}, beforeAction);
        $j(CLASS_BUTTON_FILTER_NEWEST).bind('click', { sort : 'by-newest'}, beforeAction);
        $j(CLASS_BUTTON_FILTER_ALPHABETICAL).bind('click', { sort : 'by-alphabetical'}, beforeAction);

        $j('.btn-participate').bind('click', beforeParticipate);
    };

    /**
     * Expose private method as public
     * init <> FacebookApiExtension::initialize()
     */
    return {
        init : initialize
    }
};
