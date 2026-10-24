===source===
<?php
use A\mixed;
===errors >=8.0===
Cannot use A\mixed as mixed because 'mixed' is a special class name
===php_error >=8.0===
PHP Fatal error:  Cannot use A\mixed as mixed because 'mixed' is a special class name in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "mixed"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 17
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 17
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
