===source===
<?php
namespace N;
use X\A as B;
class K extends B {
    public function h(): parent|\X\A {}
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
===errors >=8.5===
Duplicate type X\A is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting ';' or '{' in Standard input code on line 5
===php_error >=8.5===
PHP Fatal error:  Duplicate type X\A is redundant in Standard input code on line 5
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
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "X",
                  "A"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 23,
                  "end": 26
                }
              },
              "alias": {
                "name": "B",
                "span": {
                  "start": 30,
                  "end": 31
                }
              },
              "span": {
                "start": 23,
                "end": 31
              }
            }
          ]
        }
      },
      "span": {
        "start": 19,
        "end": 32
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "K",
            "span": {
              "start": 39,
              "end": 40
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
              "start": 49,
              "end": 50
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "h",
                    "span": {
                      "start": 73,
                      "end": 74
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
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
                                "parent"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 78,
                                "end": 84
                              }
                            }
                          },
                          "span": {
                            "start": 78,
                            "end": 84
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "X",
                                "A"
                              ],
                              "kind": "FullyQualified",
                              "span": {
                                "start": 85,
                                "end": 89
                              }
                            }
                          },
                          "span": {
                            "start": 85,
                            "end": 89
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 78,
                      "end": 89
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 57,
                "end": 92
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 33,
        "end": 94
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 94
  }
}
