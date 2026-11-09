===source===
<?php
namespace N;
class A {
    function c(): (A&X)|self {}
}
===errors <=7.4===
'intersection types' requires PHP 8.1 or higher
'union types' requires PHP 8.0 or higher
'DNF types' requires PHP 8.2 or higher
===errors 8.0===
'intersection types' requires PHP 8.1 or higher
'DNF types' requires PHP 8.2 or higher
===errors 8.1===
'DNF types' requires PHP 8.2 or higher
===errors >=8.5===
Type N\A&N\X is redundant as it is more restrictive than type N\A
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(' in Standard input code on line 4
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(" in Standard input code on line 4
===php_error >=8.5===
PHP Fatal error:  Type N\A&N\X is redundant as it is more restrictive than type N\A in Standard input code on line 4
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
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 25,
              "end": 26
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
                    "name": "c",
                    "span": {
                      "start": 42,
                      "end": 43
                    }
                  },
                  "by_ref": false,
                  "params": [],
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
                                      "start": 48,
                                      "end": 49
                                    }
                                  }
                                },
                                "span": {
                                  "start": 48,
                                  "end": 49
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "X"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 50,
                                      "end": 51
                                    }
                                  }
                                },
                                "span": {
                                  "start": 50,
                                  "end": 51
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 47,
                            "end": 52
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "self"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 53,
                                "end": 57
                              }
                            }
                          },
                          "span": {
                            "start": 53,
                            "end": 57
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 47,
                      "end": 57
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 60
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
