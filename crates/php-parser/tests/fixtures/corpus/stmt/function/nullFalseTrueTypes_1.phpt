===source===
<?php

function f_null(): null {}
function f_false(): false {}
function f_true(): true {}
===errors <=7.4===
'null type' requires PHP 8.0 or higher
'null as standalone type' requires PHP 8.2 or higher
'false type' requires PHP 8.0 or higher
'false as standalone type' requires PHP 8.2 or higher
'true type' requires PHP 8.2 or higher
===errors 8.0-8.1===
'null as standalone type' requires PHP 8.2 or higher
'false as standalone type' requires PHP 8.2 or higher
'true type' requires PHP 8.2 or higher
===php_error <=7.4===
PHP Fatal error:  Cannot use 'null' as class name as it is reserved in Standard input code on line 3
===php_error 8.0-8.1===
PHP Fatal error:  Null can not be used as a standalone type in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f_null",
            "span": {
              "start": 16,
              "end": 22
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "null"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 26,
                  "end": 30
                }
              }
            },
            "span": {
              "start": 26,
              "end": 30
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 33
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f_false",
            "span": {
              "start": 43,
              "end": 50
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "false"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 54,
                  "end": 59
                }
              }
            },
            "span": {
              "start": 54,
              "end": 59
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 34,
        "end": 62
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f_true",
            "span": {
              "start": 72,
              "end": 78
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "true"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 82,
                  "end": 86
                }
              }
            },
            "span": {
              "start": 82,
              "end": 86
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 63,
        "end": 89
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 89
  }
}
