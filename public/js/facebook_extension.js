/**
 * @author                 Didier Youn <didier.youn@gmail.com>
 * @copyright              Copyright (c) 2016 Did Youn
 * @link                   http://www.didier-youn.com
 */
var FacebookApiExtension = function () {
    /** Init variables used in the module helper */
    var $j = jQuery.noConflict();

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
              success : function (response) {
                  callback(response);
              }
          })
    };

    /**
     * Add like
     */
    var addLike = function () {
        var state = send({
            method : 'GET',
            url : 'add/like',
            data : {
                test : 'test'
            }
        }, function(response) {
            console.log('Did : ' + response);
        });
    };

    var addPicture = function () {
        var state = send({
            method : 'GET',
            url : 'add/picture',
            data : {
                test : 'test'
            }
        }, function(response) {
            console.log('Did : ' + response);
        });
    };

    var initialize = function () {
        console.log('bonjour');
    };

    return {
        init : initialize,
        action : {
            like : addLike,
            picture : addPicture
        },
        picture : {

        },
        rates : {

        }
    }
};
