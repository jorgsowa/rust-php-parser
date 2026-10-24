===source===
<?php
function f(A&B $x = null) {}
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
===errors 8.1===
Cannot use null as default value for parameter $x of type A&B
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'B' (T_STRING), expecting variable (T_VARIABLE) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "B", expecting variable in Standard input code on line 2
===php_error 8.1===
PHP Fatal error:  Cannot use null as default value for parameter $x of type A&B in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 21,
                  "end": 23
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
                            "B"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 19,
                            "end": 20
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 20
                      }
                    }
                  ]
                },
                "span": {
                  "start": 17,
                  "end": 20
                }
              },
              "default": {
                "kind": "Null",
                "span": {
                  "start": 26,
                  "end": 30
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 30
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
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
