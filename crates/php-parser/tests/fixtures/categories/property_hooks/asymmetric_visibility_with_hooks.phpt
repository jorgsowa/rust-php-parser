===config===
min_php=8.4
===source===
<?php
class Foo {
    public private(set) int $prop {
        get { return $this->prop; }
        set(int $v) { $this->prop = $v; }
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
                "Property": {
                  "name": "prop",
                  "visibility": "Public",
                  "set_visibility": "Private",
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 42,
                          "end": 45
                        }
                      }
                    },
                    "span": {
                      "start": 42,
                      "end": 45
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Return": {
                                "kind": {
                                  "PropertyAccess": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 75,
                                        "end": 80
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "prop"
                                      },
                                      "span": {
                                        "start": 82,
                                        "end": 86
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 75,
                                  "end": 86
                                }
                              }
                            },
                            "span": {
                              "start": 68,
                              "end": 87
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 62,
                        "end": 89
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "Assign": {
                                    "target": {
                                      "kind": {
                                        "PropertyAccess": {
                                          "object": {
                                            "kind": {
                                              "Variable": "this"
                                            },
                                            "span": {
                                              "start": 112,
                                              "end": 117
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "prop"
                                            },
                                            "span": {
                                              "start": 119,
                                              "end": 123
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 112,
                                        "end": 123
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "Variable": "v"
                                      },
                                      "span": {
                                        "start": 126,
                                        "end": 128
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 112,
                                  "end": 128
                                }
                              }
                            },
                            "span": {
                              "start": 112,
                              "end": 129
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [
                        {
                          "name": "v",
                          "type_hint": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "int"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 102,
                                  "end": 105
                                }
                              }
                            },
                            "span": {
                              "start": 102,
                              "end": 105
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "is_readonly": false,
                          "is_final": false,
                          "visibility": null,
                          "set_visibility": null,
                          "attributes": [],
                          "span": {
                            "start": 102,
                            "end": 108
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 98,
                        "end": 131
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 22,
                "end": 137
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 139
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 139
  }
}
