<?php

/*Setup and configuration for the TicketBear package. */

/*** Different ticket status options you want to be available.
 * When filling out the ticket request form, your customer should
 * choose one of these categories.
 ***/
if(!defined('STATUSES'))
    define("STATUSES", [
        "New",
        "Assigned",
        "In Progress",
        "Completed",
        "Closed"]
    );

/*** Which statuses mean the ticket is done? ***/
if(!defined("COMPLETE_STATUSES"))
    define("COMPLETE_STATUSES", [
        "Completed",
        "Closed"]
    );

/*** Different ticket categories that are available,
 * along with default priorities. 
 ***/
if(!defined("CATEGORIES"))
    define("CATEGORIES", [
        "Customer Service" => 1,
        "Technical Issue" => 2,
        "Billing" => 3]
    );

/*** Highest priority on the scale ***/
if(!defined("MAX_PRIORITY"))
    define("MAX_PRIORITY", 3);

/*** Highest priority assigned to the agent ticket pool.
 * We'll automatically assign tickets to be picked up by
 * either agents or admins. Tickets higher than this value
 * in priority will go to admins. Lower or equal will go to
 * agents.
 ***/
if(!defined("AGENT_MAX"))
    define("AGENT_MAX",2);

/*** Custom string fields for the table.
 * If there's any other data you'd like to collect, we'll
 * create table columns for that based on this array.
 **/
if(!defined("CUSTOM_FIELDS"))
    define("CUSTOM_FIELDS", []);

/*** What route do you want TicketBear stuff to use?
 * For example, the form will end up at 
 * [your site]/TicketBear/create .
 ***/
if(!defined("TB_ROOT"))
    define("TB_ROOT","/TicketBear/");

/*
 * Installation things to do:
 * Require helpers.php in boostrap/app.php
 */
