<?php

/**
 * @api {get} /api/v1/users/{id} Get User Information
 * @apiHeader {String} authorization Authorization value.
 * @apiHeaderExample {json} Header-Example:
 *     {
 *       "Authorization": "Bearer JWT-token"
 *     }
 * @apiParam {string} uuid Users unique ID.
 * @apiName GetUser
 * @apiGroup User
 * @apiSuccess {String} uuid  Uuid of the User.
 * @apiSuccess {String} username User name.
 * @apiSuccess {String} email User email.
 * @apiSuccessExample Success-Response:
 *     {
 *       "id": "00a8b2ad-2ec2-470a-96a4-85acd144075a",
 *       "username": "kpicaza",
 *       "email": "kpicaza@gtest.mail"
 *     }
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 */

/**
 * @api {post} /api/v1/users Create new user
 * @apiName PostUser
 * @apiGroup User
 * @apiSuccess (Success 201) (Success 201) {String} username User name.
 * @apiSuccess (Success 201) {String} email User email.
 * @apiSuccess (Success 201) {String} password  The User Password.
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 201 Created
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 400 Bad request
 */

/**
 * @api {post} /api/v1/users/credentials Request User Credentials
 * @apiName GetJwtToken
 * @apiParam {string} username User unique username.
 * @apiParam {string} password User password..
 * @apiGroup Security
 * @apiSuccess {String} access_token Jwt Token of the User.
 * @apiSuccess {String} uuid  Uuid of the User.
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "access_token": "token_value",
 *       "uuid": "user_uuid"
 *     }
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 400 Bad request
 */

/**
 * @api {get} /api/v1/tasks Get list of Tasks
 * @apiHeader {String} authorization Authorization value.
 * @apiHeaderExample {json} Header-Example:
 *     {
 *       "Authorization": "Bearer JWT-token"
 *     }
 * @apiName IndexTasks
 * @apiGroup Task
 * @apiSuccess {String} id  Uuid of the Task.
 * @apiSuccess {String} description Task description.
 * @apiSuccess {datetime} createdAt Task creation datetime.
 * @apiSuccess {datetime} updatedAt Task last modification datetime.
 * @apiSuccessExample Success-Response:
 *     [
 *       {
 *         "id": "9169d529-4ac5-4890-989e-9fc539c391c4",
 *         "description": "hola mundo",  "progress": {
 *           "progress": 53,
 *           "isDone": false
 *         },
 *         "createdAt": {
 *           "date": "2016-09-08 20:34:12.000000",
 *           "timezone_type": 3,
 *           "timezone": "Europe/Madrid"
 *         },
 *         "updatedAt": {
 *           "date": "2016-09-08 20:52:30.000000",
 *           "timezone_type": 3,
 *           "timezone": "Europe/Madrid"
 *         }
*        }
 *     ]
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 401 Access denied
 */

/**
 * @api {get} /api/v1/tasks/{id} Get Task Information
 * @apiHeader {String} authorization Authorization value.
 * @apiHeaderExample {json} Header-Example:
 *     {
 *       "Authorization": "Bearer JWT-token"
 *     }
 * @apiParam {string} uuid Users unique ID.
 * @apiName GetTask
 * @apiGroup Task
 * @apiSuccess {String} id  Uuid of the Task.
 * @apiSuccess {String} description Task description.
 * @apiSuccess {datetime} createdAt Task creation datetime.
 * @apiSuccess {datetime} updatedAt Task last modification datetime.
 * @apiSuccessExample Success-Response:
 *     {
 *       "id": "9169d529-4ac5-4890-989e-9fc539c391c4",
 *       "description": "hola mundo",  "progress": {
 *         "progress": 53,
 *         "isDone": false
 *       },
 *       "createdAt": {
 *         "date": "2016-09-08 20:34:12.000000",
 *         "timezone_type": 3,
 *         "timezone": "Europe/Madrid"
 *       },
 *       "updatedAt": {
 *         "date": "2016-09-08 20:52:30.000000",
 *         "timezone_type": 3,
 *         "timezone": "Europe/Madrid"
 *       }
 *     }
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 */

/**
 * @api {post} /api/v1/tasks Create new Task
 * @apiName PostTask
 * @apiGroup Task
 * @apiHeader {String} authorization Authorization value.
 * @apiHeaderExample {json} Header-Example:
 *     {
 *       "Authorization": "Bearer JWT-token"
 *     }
 * @apiSuccess (Success 201) {String} description Task description.
 * @apiSuccess (Success 201) {Number} progress Task progress percentage.
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 201 Created
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 400 Bad request
 */

/**
 * @api {patch} /api/v1/tasks/{id} Update a Task
 * @apiParam {string} uuid Task unique ID.
 * @apiName PatchTask
 * @apiGroup Task
 * @apiHeader {String} authorization Authorization value.
 * @apiHeaderExample {json} Header-Example:
 *     {
 *       "Authorization": "Bearer JWT-token"
 *     }
 * @apiSuccess (Success 202) {String} replace Task field to update, valid values `username`, `description`.
 * @apiSuccess (Success 202) {string} value Value for updated field.
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 202 Accepted
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 400 Bad request
 */

/**
 * @api {delete} /api/v1/tasks/{id} Delete a Task
 * @apiParam {string} uuid Task unique ID.
 * @apiName DeleteTask
 * @apiGroup Task
 * @apiHeader {String} authorization Authorization value.
 * @apiHeaderExample {json} Header-Example:
 *     {
 *       "Authorization": "Bearer JWT-token"
 *     }
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 204 No Content
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 */
