===source===
<?php
namespace N;
class A {
    function b(): self|\N\A {}
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
===errors >=8.5===
Duplicate type N\A is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting ';' or '{' in Standard input code on line 4
===php_error >=8.5===
PHP Fatal error:  Duplicate type N\A is redundant in Standard input code on line 4
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
                    "name": "b",
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
                            "Named": {
                              "parts": [
                                "self"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 47,
                                "end": 51
                              }
                            }
                          },
                          "span": {
                            "start": 47,
                            "end": 51
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "N",
                                "A"
                              ],
                              "kind": "FullyQualified",
                              "span": {
                                "start": 52,
                                "end": 56
                              }
                            }
                          },
                          "span": {
                            "start": 52,
                            "end": 56
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 47,
                      "end": 56
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 59
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 61
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}
