===source===
<?php
function g(): A|B|(A&C)|(B&D) {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
'intersection types' requires PHP 8.1 or higher
'intersection types' requires PHP 8.1 or higher
'DNF types' requires PHP 8.2 or higher
Type A&C is redundant as it is more restrictive than type A
Type B&D is redundant as it is more restrictive than type B
===errors 8.0===
'intersection types' requires PHP 8.1 or higher
'intersection types' requires PHP 8.1 or higher
'DNF types' requires PHP 8.2 or higher
Type A&C is redundant as it is more restrictive than type A
Type B&D is redundant as it is more restrictive than type B
===errors 8.1===
'DNF types' requires PHP 8.2 or higher
Type A&C is redundant as it is more restrictive than type A
Type B&D is redundant as it is more restrictive than type B
===errors >=8.2===
Type A&C is redundant as it is more restrictive than type A
Type B&D is redundant as it is more restrictive than type B
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 2
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(" in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Type A&C is redundant as it is more restrictive than type A in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
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
                },
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
                              "start": 25,
                              "end": 26
                            }
                          }
                        },
                        "span": {
                          "start": 25,
                          "end": 26
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
                              "start": 27,
                              "end": 28
                            }
                          }
                        },
                        "span": {
                          "start": 27,
                          "end": 28
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 24,
                    "end": 29
                  }
                },
                {
                  "kind": {
                    "Intersection": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "B"
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
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "D"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 33,
                              "end": 34
                            }
                          }
                        },
                        "span": {
                          "start": 33,
                          "end": 34
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 30,
                    "end": 35
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 35
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
