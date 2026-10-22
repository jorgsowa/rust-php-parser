===source===
<?php function baz(): (A&B)|(C&D) {}
===errors <=7.4===
'intersection types' requires PHP 8.1 or higher
'union types' requires PHP 8.0 or higher
'intersection types' requires PHP 8.1 or higher
'DNF types' requires PHP 8.2 or higher
===errors 8.0===
'intersection types' requires PHP 8.1 or higher
'intersection types' requires PHP 8.1 or higher
'DNF types' requires PHP 8.2 or higher
===errors 8.1===
'DNF types' requires PHP 8.2 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(' in Standard input code on line 1
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "baz",
            "span": {
              "start": 15,
              "end": 18
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
                              "B"
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
                    "start": 22,
                    "end": 27
                  }
                },
                {
                  "kind": {
                    "Intersection": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "C"
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
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "D"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 31,
                              "end": 32
                            }
                          }
                        },
                        "span": {
                          "start": 31,
                          "end": 32
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 28,
                    "end": 33
                  }
                }
              ]
            },
            "span": {
              "start": 22,
              "end": 33
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
