<?php

/*Setup and configuration for the TicketBear package. */

/*** Different ticket status options you want to be available ***/
define("STATUSES", [
    "New",
    "Assigned",
    "In Progress",
    "Completed",
    "Closed"]
);

/*** Which statuses mean the ticket is done? ***/
define("COMPLETE_STATUSES", [
    "Completed",
    "Closed"]
);

/*** Different ticket categories that are available ***/
define("CATEGORIES", [
    "Customer Service",
    "Technical Issue",
    "Billing"]
);

/*** Custom string fields for the table ***/
define("CUSTOM_FIELDS", []);

/*** Highest priority ***/
define("MAX_PRIORITY", 5);

/*** What route do you want TicketBear stuff to use? ***/
define("TB_ROOT","/TicketBear/");
