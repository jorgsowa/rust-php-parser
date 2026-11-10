===source===
<?php
function f(): (A&B&C)&D {}
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
'intersection types' requires PHP 8.1 or higher
expected '|', found '&'
===errors >=8.1===
expected '|', found '&'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(' in Standard input code on line 2
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(" in Standard input code on line 2
===php_error >=8.2===
PHP Parse error:  syntax error, unexpected token "&", expecting "|" in Standard input code on line 2
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
              "Intersection": [
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
                              "start": 21,
                              "end": 22
                            }
                          }
                        },
                        "span": {
                          "start": 21,
                          "end": 22
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
                              "start": 23,
                              "end": 24
                            }
                          }
                        },
                        "span": {
                          "start": 23,
                          "end": 24
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
                              "start": 25,
                              "end": 26
                            }
                          }
                        },
                        "span": {
                          "start": 25,
                          "end": 26
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 20,
                    "end": 27
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "D"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 28,
                        "end": 29
                      }
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 29
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 29
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
