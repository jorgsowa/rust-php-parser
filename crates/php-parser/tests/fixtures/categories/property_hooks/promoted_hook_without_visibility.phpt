===source===
<?php
class C {
    public function __construct(
        $prop { set => $value * 2; },
        int $x = 1 { get => 1; },
    ) {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                    "name": "__construct",
                    "span": {
                      "start": 36,
                      "end": 47
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "prop",
                        "span": {
                          "start": 57,
                          "end": 62
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "hooks": [
                        {
                          "kind": "Set",
                          "body": {
                            "Expression": {
                              "kind": {
                                "Binary": {
                                  "left": {
                                    "kind": {
                                      "Variable": "value"
                                    },
                                    "span": {
                                      "start": 72,
                                      "end": 78
                                    }
                                  },
                                  "op": "Mul",
                                  "right": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 81,
                                      "end": 82
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 72,
                                "end": 82
                              }
                            }
                          },
                          "is_final": false,
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 65,
                            "end": 83
                          }
                        }
                      ],
                      "span": {
                        "start": 57,
                        "end": 85
                      }
                    },
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 99,
                          "end": 101
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 95,
                              "end": 98
                            }
                          }
                        },
                        "span": {
                          "start": 95,
                          "end": 98
                        }
                      },
                      "default": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 104,
                          "end": 105
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "hooks": [
                        {
                          "kind": "Get",
                          "body": {
                            "Expression": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 115,
                                "end": 116
                              }
                            }
                          },
                          "is_final": false,
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 108,
                            "end": 117
                          }
                        }
                      ],
                      "span": {
                        "start": 95,
                        "end": 119
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 129
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 131
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 131
  }
}
