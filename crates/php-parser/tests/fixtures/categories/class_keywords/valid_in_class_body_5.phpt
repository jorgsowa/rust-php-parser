===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php function f() { return new class extends B { function g() { return parent::h(); } }; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
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
                    "New": {
                      "class": {
                        "kind": {
                          "AnonymousClass": {
                            "name": null,
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
                                "start": 46,
                                "end": 47
                              }
                            },
                            "implements": [],
                            "members": [
                              {
                                "kind": {
                                  "Method": {
                                    "name": {
                                      "name": "g",
                                      "span": {
                                        "start": 59,
                                        "end": 60
                                      }
                                    },
                                    "by_ref": false,
                                    "params": [],
                                    "return_type": null,
                                    "body": [
                                      {
                                        "kind": {
                                          "Return": {
                                            "kind": {
                                              "StaticMethodCall": {
                                                "class": {
                                                  "kind": {
                                                    "Name": {
                                                      "parts": [
                                                        "parent"
                                                      ],
                                                      "kind": "Unqualified",
                                                      "span": {
                                                        "start": 72,
                                                        "end": 78
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 72,
                                                    "end": 78
                                                  }
                                                },
                                                "method": {
                                                  "kind": {
                                                    "Identifier": "h"
                                                  },
                                                  "span": {
                                                    "start": 80,
                                                    "end": 81
                                                  }
                                                },
                                                "args": []
                                              }
                                            },
                                            "span": {
                                              "start": 72,
                                              "end": 83
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 65,
                                          "end": 84
                                        }
                                      }
                                    ],
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 50,
                                  "end": 86
                                }
                              }
                            ],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 28,
                          "end": 88
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 88
                  }
                }
              },
              "span": {
                "start": 21,
                "end": 89
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 91
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 91
  }
}
