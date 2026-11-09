===source===
<?php
function f(): (bool&A)|B {}
===errors <=7.4===
'intersection types' requires PHP 8.1 or higher
'union types' requires PHP 8.0 or higher
'DNF types' requires PHP 8.2 or higher
Type bool cannot be part of an intersection type
===errors 8.0===
'intersection types' requires PHP 8.1 or higher
'DNF types' requires PHP 8.2 or higher
Type bool cannot be part of an intersection type
===errors 8.1===
'DNF types' requires PHP 8.2 or higher
Type bool cannot be part of an intersection type
===errors >=8.2===
Type bool cannot be part of an intersection type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(' in Standard input code on line 2
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(" in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Type bool cannot be part of an intersection type in Standard input code on line 2
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
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Intersection": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "bool"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 21,
                              "end": 25
                            }
                          }
                        },
                        "span": {
                          "start": 21,
                          "end": 25
                        }
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 26,
                              "end": 27
                            }
                          }
                        },
                        "span": {
                          "start": 26,
                          "end": 27
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 20,
                    "end": 28
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
                        "start": 29,
                        "end": 30
                      }
                    }
                  },
                  "span": {
                    "start": 29,
                    "end": 30
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 30
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
