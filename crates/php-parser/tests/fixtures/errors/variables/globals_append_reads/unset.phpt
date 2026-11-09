===source===
<?php
unset($GLOBALS[]);
===errors===
Cannot use [] for unsetting
===php_error===
PHP Fatal error:  Cannot use [] for unsetting in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "Variable": "GLOBALS"
                  },
                  "span": {
                    "start": 12,
                    "end": 20
                  }
                },
                "index": null
              }
            },
            "span": {
              "start": 12,
              "end": 22
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
