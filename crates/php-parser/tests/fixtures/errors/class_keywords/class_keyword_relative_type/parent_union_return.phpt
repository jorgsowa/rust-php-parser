===source===
<?php
function g(): namespace\parent|int {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Cannot use "parent" when no class scope is active
===errors >=8.0===
Cannot use "parent" when no class scope is active
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Cannot use "parent" when no class scope is active in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "parent"
                      ],
                      "kind": "Relative",
                      "span": {
                        "start": 20,
                        "end": 36
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 36
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "int"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 37,
                        "end": 40
                      }
                    }
                  },
                  "span": {
                    "start": 37,
                    "end": 40
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 40
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
