===source===
<?php
class D {
    public function n() {
        return function (): (self&A)|B {};
    }
}
===errors <=7.4===
'intersection types' requires PHP 8.1 or higher
'union types' requires PHP 8.0 or higher
'DNF types' requires PHP 8.2 or higher
Type self cannot be part of an intersection type
===errors 8.0===
'intersection types' requires PHP 8.1 or higher
'DNF types' requires PHP 8.2 or higher
Type self cannot be part of an intersection type
===errors 8.1===
'DNF types' requires PHP 8.2 or higher
Type self cannot be part of an intersection type
===errors >=8.2===
Type self cannot be part of an intersection type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(' in Standard input code on line 4
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(" in Standard input code on line 4
===php_error >=8.2===
PHP Fatal error:  Type self cannot be part of an intersection type in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "D",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "n",
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Closure": {
                              "is_static": false,
                              "by_ref": false,
                              "params": [],
                              "use_vars": [],
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
                                                  "self"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 71,
                                                  "end": 75
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 71,
                                              "end": 75
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
                                                  "start": 76,
                                                  "end": 77
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 76,
                                              "end": 77
                                            }
                                          }
                                        ]
                                      },
                                      "span": {
                                        "start": 70,
                                        "end": 78
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
                                            "start": 79,
                                            "end": 80
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 79,
                                        "end": 80
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 70,
                                  "end": 80
                                }
                              },
                              "body": [],
                              "attributes": []
                            }
                          },
                          "span": {
                            "start": 57,
                            "end": 83
                          }
                        }
                      },
                      "span": {
                        "start": 50,
                        "end": 84
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 90
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 92
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92
  }
}
