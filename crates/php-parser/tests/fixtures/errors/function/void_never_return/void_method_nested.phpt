===source===
<?php
class A {
    public function m(): void { if (true) { return 1; } }
}
===errors===
A void method must not return a value
===php_error <=8.3===
PHP Fatal error:  A void function must not return a value in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  A void method must not return a value in Standard input code on line 3
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
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
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
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 41,
                          "end": 45
                        }
                      }
                    },
                    "span": {
                      "start": 41,
                      "end": 45
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
                              "start": 52,
                              "end": 56
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
                                        "start": 67,
                                        "end": 68
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 60,
                                    "end": 69
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 58,
                              "end": 71
                            }
                          },
                          "elseif_branches": [],
                          "else_branch": null
                        }
                      },
                      "span": {
                        "start": 48,
                        "end": 71
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 73
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 75
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 75
  }
}
