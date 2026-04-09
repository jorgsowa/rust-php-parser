===source===
<?php

const C = new Foo;

function a($x = new Foo) {
    static $y = new Foo;
}

#[Attr(new Foo)]
class Bar {
    const C = new Foo;
    public $prop = new Foo;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": "C",
            "value": {
              "kind": {
                "New": {
                  "class": {
                    "kind": {
                      "Identifier": "Foo"
                    },
                    "span": {
                      "start": 21,
                      "end": 24,
                      "start_line": 3,
                      "start_col": 14
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 17,
                "end": 24,
                "start_line": 3,
                "start_col": 10
              }
            },
            "attributes": [],
            "span": {
              "start": 13,
              "end": 24,
              "start_line": 3,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 7,
        "end": 27,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "a",
          "params": [
            {
              "name": "x",
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 47,
                        "end": 50,
                        "start_line": 5,
                        "start_col": 20
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 43,
                  "end": 50,
                  "start_line": 5,
                  "start_col": 16
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
                "start": 38,
                "end": 50,
                "start_line": 5,
                "start_col": 11
              }
            }
          ],
          "body": [
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": "y",
                    "default": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Identifier": "Foo"
                            },
                            "span": {
                              "start": 74,
                              "end": 77,
                              "start_line": 6,
                              "start_col": 20
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 70,
                        "end": 77,
                        "start_line": 6,
                        "start_col": 16
                      }
                    },
                    "span": {
                      "start": 65,
                      "end": 77,
                      "start_line": 6,
                      "start_col": 11
                    }
                  }
                ]
              },
              "span": {
                "start": 58,
                "end": 79,
                "start_line": 6,
                "start_col": 4
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 27,
        "end": 80,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "Bar",
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
                  "name": "C",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Identifier": "Foo"
                          },
                          "span": {
                            "start": 129,
                            "end": 132,
                            "start_line": 11,
                            "start_col": 18
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 125,
                      "end": 132,
                      "start_line": 11,
                      "start_col": 14
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 115,
                "end": 138,
                "start_line": 11,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "prop",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Identifier": "Foo"
                          },
                          "span": {
                            "start": 157,
                            "end": 160,
                            "start_line": 12,
                            "start_col": 23
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 153,
                      "end": 160,
                      "start_line": 12,
                      "start_col": 19
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 138,
                "end": 160,
                "start_line": 12,
                "start_col": 4
              }
            }
          ],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attr"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 84,
                  "end": 88,
                  "start_line": 9,
                  "start_col": 2
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Identifier": "Foo"
                          },
                          "span": {
                            "start": 93,
                            "end": 96,
                            "start_line": 9,
                            "start_col": 11
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 89,
                      "end": 96,
                      "start_line": 9,
                      "start_col": 7
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 89,
                    "end": 96,
                    "start_line": 9,
                    "start_col": 7
                  }
                }
              ],
              "span": {
                "start": 84,
                "end": 97,
                "start_line": 9,
                "start_col": 2
              }
            }
          ]
        }
      },
      "span": {
        "start": 99,
        "end": 163,
        "start_line": 10,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 163,
    "start_line": 1,
    "start_col": 0
  }
}
