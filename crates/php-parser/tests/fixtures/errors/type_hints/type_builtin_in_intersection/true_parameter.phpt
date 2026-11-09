===source===
<?php
function o(A&true $o) {}
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
'true type' requires PHP 8.2 or higher
Type true cannot be part of an intersection type
===errors 8.1===
'true type' requires PHP 8.2 or higher
Type true cannot be part of an intersection type
===errors >=8.2===
Type true cannot be part of an intersection type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'true' (T_STRING), expecting variable (T_VARIABLE) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "true", expecting variable in Standard input code on line 2
===php_error 8.1===
PHP Fatal error:  Cannot use 'true' as class name as it is reserved in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Type true cannot be part of an intersection type in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "o",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "o",
                "span": {
                  "start": 24,
                  "end": 26
                }
              },
              "type_hint": {
                "kind": {
                  "Intersection": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 17,
                            "end": 18
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 18
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "true"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 19,
                            "end": 23
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 23
                      }
                    }
                  ]
                },
                "span": {
                  "start": 17,
                  "end": 23
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 26
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
