/**
 * @author                 Didier Youn <didier.youn@gmail.com>
 * @copyright              Copyright (c) 2016 Did Youn
 * @link                   http://www.didier-youn.com
 */
var FacebookApiExtension = function () {
    /** Init variables used in the module helper */
    var $j = jQuery.noConflict();

    /**
     * Class used as button identifier
     * @type {string}
     */
    var CLASS_BUTTON_ADD_LIKE   = '.btn-like';
    var CLASS_BUTTON_ADD_SHARE  = '.btn-share';
    var CLASS_BUTTON_ADD_VOTE   = '.btn-vote';

    /**
     * Mapping of actions and AJAX routes used
     *
     * @type {{like: string, share: string, picture: string}}
     */
    var PATH_ACTIONS = {
        'like' : '/add/like',
        'share' : '/add/share',
        'vote' : '/add/vote',
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
            method : option.method || 'GET',
            data : option.data,
            beforeSend : beforeSend,
            success : function (response) {
                console.log('Ajax finish, return callback');
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
     * @param {string} action
     */
    var getContextData = function(element, action) {
        var parent = element.closest('.image'), elementId = parent.attr('data-id'), pattern = '^[a-zA-Z]*-(\\d*)$',
            regex = new RegExp(pattern, 'g'), matches = regex.exec(elementId);
        if (matches === null && typeof matches['index'] === 'undefined'
        || typeof action === 'undefined') {
            return false;
        }
        var targetId = parseInt(matches[1]), path = PATH_ACTIONS[action];

        return {
            url : path,
            method : 'GET',
            data : {
                id : targetId
            }
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
            action = e.data.action,
            options = getContextData(target, action);
        if (!options) {
            return false;
        }
        send(options, function(response) {
            alert('Did : ' + response);
        });
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
    };

    /**
     * Expose private method as public
     * init <> FacebookApiExtension::initialize()
     */
    return {
        init : initialize
    }
};
