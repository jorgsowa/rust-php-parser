===source===
<?php
function () use (&$GLOBALS) {};
===errors===
Cannot use auto-global as lexical variable
===php_error===
PHP Fatal error:  Cannot use auto-global as lexical variable in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Closure": {
              "is_static": false,
              "by_ref": false,
              "params": [],
              "use_vars": [
                {
                  "name": {
                    "name": "GLOBALS",
                    "span": {
                      "start": 24,
                      "end": 32
                    }
                  },
                  "by_ref": true,
                  "span": {
                    "start": 23,
                    "end": 32
                  }
                }
              ],
              "return_type": null,
              "body": [],
              "attributes": []
            }
          },
          "span": {
            "start": 6,
            "end": 36
          }
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
