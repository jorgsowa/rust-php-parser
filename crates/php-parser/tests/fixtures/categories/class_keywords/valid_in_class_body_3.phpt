===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php class A { function f() { $g = function () { return parent::g(); }; } }
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
                    "name": "f",
                    "span": {
                      "start": 25,
                      "end": 26
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "Variable": "g"
                                },
                                "span": {
                                  "start": 31,
                                  "end": 33
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Closure": {
                                    "is_static": false,
                                    "by_ref": false,
                                    "params": [],
                                    "use_vars": [],
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
                                                        "start": 57,
                                                        "end": 63
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 57,
                                                    "end": 63
                                                  }
                                                },
                                                "method": {
                                                  "kind": {
                                                    "Identifier": "g"
                                                  },
                                                  "span": {
                                                    "start": 65,
                                                    "end": 66
                                                  }
                                                },
                                                "args": []
                                              }
                                            },
                                            "span": {
                                              "start": 57,
                                              "end": 68
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 50,
                                          "end": 69
                                        }
                                      }
                                    ],
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 36,
                                  "end": 71
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 31,
                            "end": 71
                          }
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 72
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 74
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 76
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 76
  }
}
