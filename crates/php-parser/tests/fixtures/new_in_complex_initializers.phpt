===source===
<?php
function foo(
    $a = new Foo(),
    $b = new Bar(1, 'test'),
    $c = new Baz(name: 'x'),
) {}
class Config {
    const DEFAULT = new Settings(debug: false);
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "a",
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 33,
                        "end": 36,
                        "start_line": 3,
                        "start_col": 13
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 29,
                  "end": 38,
                  "start_line": 3,
                  "start_col": 9
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 24,
                "end": 38,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "name": "b",
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "Bar"
                      },
                      "span": {
                        "start": 53,
                        "end": 56,
                        "start_line": 4,
                        "start_col": 13
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 57,
                            "end": 58,
                            "start_line": 4,
                            "start_col": 17
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 57,
                          "end": 58,
                          "start_line": 4,
                          "start_col": 17
                        }
                      },
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "String": "test"
                          },
                          "span": {
                            "start": 60,
                            "end": 66,
                            "start_line": 4,
                            "start_col": 20
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 60,
                          "end": 66,
                          "start_line": 4,
                          "start_col": 20
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 49,
                  "end": 67,
                  "start_line": 4,
                  "start_col": 9
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 44,
                "end": 67,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "name": "c",
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "Baz"
                      },
                      "span": {
                        "start": 82,
                        "end": 85,
                        "start_line": 5,
                        "start_col": 13
                      }
                    },
                    "args": [
                      {
                        "name": "name",
                        "value": {
                          "kind": {
                            "String": "x"
                          },
                          "span": {
                            "start": 92,
                            "end": 95,
                            "start_line": 5,
                            "start_col": 23
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 86,
                          "end": 95,
                          "start_line": 5,
                          "start_col": 17
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 78,
                  "end": 96,
                  "start_line": 5,
                  "start_col": 9
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 73,
                "end": 96,
                "start_line": 5,
                "start_col": 4
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 102,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "Config",
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
                "ClassConst": {
                  "name": "DEFAULT",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Identifier": "Settings"
                          },
                          "span": {
                            "start": 142,
                            "end": 150,
                            "start_line": 8,
                            "start_col": 24
                          }
                        },
                        "args": [
                          {
                            "name": "debug",
                            "value": {
                              "kind": {
                                "Bool": false
                              },
                              "span": {
                                "start": 158,
                                "end": 163,
                                "start_line": 8,
                                "start_col": 40
                              }
                            },
                            "unpack": false,
                            "by_ref": false,
                            "span": {
                              "start": 151,
                              "end": 163,
                              "start_line": 8,
                              "start_col": 33
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 138,
                      "end": 164,
                      "start_line": 8,
                      "start_col": 20
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 122,
                "end": 166,
                "start_line": 8,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 103,
        "end": 167,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 167,
    "start_line": 1,
    "start_col": 0
  }
}
