===source===
<?php try { }
===errors===
expected catch or finally clause, found end of file
===php_error===
PHP Fatal error:  Cannot use try without catch or finally in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "TryCatch": {
          "body": [],
          "catches": [],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 13
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 13
  }
}
