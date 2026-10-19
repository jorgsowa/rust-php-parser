===source===
<?php
echo 1;
declare(encoding='UTF-8');
function f() {
    declare(encoding='UTF-8');
}
===errors===
Encoding declaration pragma must be the very first statement in the script
Encoding declaration pragma must be the very first statement in the script
===php_error===
PHP Warning:  declare(encoding=...) ignored because Zend multibyte feature is turned off by settings in Standard input code on line 3
PHP Warning:  declare(encoding=...) ignored because Zend multibyte feature is turned off by settings in Standard input code on line 5
PHP Fatal error:  Encoding declaration pragma must be the very first statement in the script in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 11,
              "end": 12
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 13
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "encoding",
              {
                "kind": {
                  "String": "UTF-8"
                },
                "span": {
                  "start": 31,
                  "end": 38
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 14,
        "end": 40
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 50,
              "end": 51
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Declare": {
                  "directives": [
                    [
                      "encoding",
                      {
                        "kind": {
                          "String": "UTF-8"
                        },
                        "span": {
                          "start": 77,
                          "end": 84
                        }
                      }
                    ]
                  ],
                  "body": null
                }
              },
              "span": {
                "start": 60,
                "end": 86
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 41,
        "end": 88
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 88
  }
}
