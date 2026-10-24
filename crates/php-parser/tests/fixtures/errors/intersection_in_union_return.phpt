===source===
<?php
function f(): A&B|C {}
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
expected '(' around an intersection type in a union, found '|'
===errors >=8.1===
expected '(' around an intersection type in a union, found '|'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '&', expecting '{' in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "&", expecting "{" in Standard input code on line 2
===php_error >=8.1===
PHP Parse error:  syntax error, unexpected token "|", expecting "{" in Standard input code on line 2
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
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 20,
                              "end": 21
                            }
                          }
                        },
                        "span": {
                          "start": 20,
                          "end": 21
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
                              "start": 22,
                              "end": 23
                            }
                          }
                        },
                        "span": {
                          "start": 22,
                          "end": 23
                        }
                      }
                    ]
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
                        "C"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 24,
                        "end": 25
                      }
                    }
                  },
                  "span": {
                    "start": 24,
                    "end": 25
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 25
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
