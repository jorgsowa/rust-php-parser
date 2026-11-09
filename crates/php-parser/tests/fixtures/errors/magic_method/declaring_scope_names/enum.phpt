===source===
<?php
namespace N;
enum E { function __call($a) {} }
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Method N\E::__call() must take exactly 2 arguments
===errors >=8.1===
Method N\E::__call() must take exactly 2 arguments
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  Method N\E::__call() must take exactly 2 arguments in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 24,
              "end": 25
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__call",
                    "span": {
                      "start": 37,
                      "end": 43
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 44,
                          "end": 46
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 44,
                        "end": 46
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 28,
                "end": 50
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}
