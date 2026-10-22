===description===
PHP rejects `return $expr` in a void function and any `return` in a never function, including inside nested control flow.
===source===
<?php
function v(): void { return 5; }
function n(): never { return; }
class A {
    public function m(): void { if (true) { return 1; } }
}
===errors <=8.0===
A void function must not return a value
A function with return type must return a value
A void function must not return a value
===errors >=8.1===
A void function must not return a value
A never-returning function must not return
A void function must not return a value
===php_error===
PHP Fatal error:  A void function must not return a value in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "v",
            "span": {
              "start": 15,
              "end": 16
            }
          },
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
          "name": {
            "name": "n",
            "span": {
              "start": 48,
              "end": 49
            }
          },
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
          "name": {
            "name": "A",
            "span": {
              "start": 77,
              "end": 78
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
                    "name": "m",
                    "span": {
                      "start": 101,
                      "end": 102
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
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
