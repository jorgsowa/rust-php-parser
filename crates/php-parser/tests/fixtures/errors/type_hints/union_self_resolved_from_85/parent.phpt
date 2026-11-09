===source===
<?php
namespace N;
class A extends B {
    function d(): B|parent {}
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
===errors >=8.5===
Duplicate type N\B is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting ';' or '{' in Standard input code on line 4
===php_error >=8.5===
PHP Fatal error:  Duplicate type N\B is redundant in Standard input code on line 4
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
          "extends": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 35,
              "end": 36
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 52,
                      "end": 53
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "B"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 57,
                                "end": 58
                              }
                            }
                          },
                          "span": {
                            "start": 57,
                            "end": 58
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "parent"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 59,
                                "end": 65
                              }
                            }
                          },
                          "span": {
                            "start": 59,
                            "end": 65
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 57,
                      "end": 65
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 43,
                "end": 68
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 70
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70
  }
}
