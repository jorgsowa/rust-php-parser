===source===
<?php
function a(): int|void {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Void can only be used as a standalone type
===errors >=8.0===
Void can only be used as a standalone type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Void can only be used as a standalone type in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "a",
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
                        "int"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 23
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 23
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "void"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 24,
                        "end": 28
                      }
                    }
                  },
                  "span": {
                    "start": 24,
                    "end": 28
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 28
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
