===source===
<?php
class A extends B {
    const C = parent::D ?? $x;
}
===errors===
Constant expression contains invalid operations
===php_error===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
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
          "extends": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 22,
              "end": 23
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "C",
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "value": {
                    "kind": {
                      "NullCoalesce": {
                        "left": {
                          "kind": {
                            "ClassConstAccess": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "parent"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 40,
                                      "end": 46
                                    }
                                  }
                                },
                                "span": {
                                  "start": 40,
                                  "end": 46
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "D"
                                },
                                "span": {
                                  "start": 48,
                                  "end": 49
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 40,
                            "end": 49
                          }
                        },
                        "right": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 53,
                            "end": 55
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 40,
                      "end": 55
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 30,
                "end": 56
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}
