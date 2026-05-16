===description===
PHP rejects:
- "A void function must not return a value" when a function declared `: void` has `return $expr;`
- "A never-returning function must not return" when a function declared `: never` has any `return`

The check walks the body through control-flow nesting (if/while/for/switch/try)
but stops at nested function/closure/class declarations whose returns are
attributed to their own scope.
===source===
<?php
function v(): void { return 5; }
function n(): never { return; }
class A {
    public function m(): void { if (true) { return 1; } }
}
===errors===
A void function must not return a value
A never-returning function must not return
A void function must not return a value
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "v",
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Int": 5
                  },
                  "span": {
                    "start": 34,
                    "end": 35
                  }
                }
              },
              "span": {
                "start": 27,
                "end": 36
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "void"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 20,
                  "end": 24
                }
              }
            },
            "span": {
              "start": 20,
              "end": 24
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
    },
    {
      "kind": {
        "Function": {
          "name": "n",
          "params": [],
          "body": [
            {
              "kind": {
                "Return": null
              },
              "span": {
                "start": 61,
                "end": 68
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "never"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 53,
                  "end": 58
                }
              }
            },
            "span": {
              "start": 53,
              "end": 58
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 39,
        "end": 70
      }
    },
    {
      "kind": {
        "Class": {
          "name": "A",
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
                  "name": "m",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 106,
                          "end": 110
                        }
                      }
                    },
                    "span": {
                      "start": 106,
                      "end": 110
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "If": {
                          "condition": {
                            "kind": {
                              "Bool": true
                            },
                            "span": {
                              "start": 117,
                              "end": 121
                            }
                          },
                          "then_branch": {
                            "kind": {
                              "Block": [
                                {
                                  "kind": {
                                    "Return": {
                                      "kind": {
                                        "Int": 1
                                      },
                                      "span": {
                                        "start": 132,
                                        "end": 133
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 125,
                                    "end": 134
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 123,
                              "end": 136
                            }
                          },
                          "elseif_branches": [],
                          "else_branch": null
                        }
                      },
                      "span": {
                        "start": 113,
                        "end": 136
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 85,
                "end": 138
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 71,
        "end": 140
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 140
  }
}
===php_error===
PHP Fatal error:  A void function must not return a value in Standard input code on line 2
