===config===
min_php=8.4
===source===
<?php
class Foo {
    public readonly string $bar {
        set(string $value) { $this->bar = $value; }
    }
}
===errors===
A readonly property cannot declare a set hook
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
                  "name": "bar",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": true,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 38,
                          "end": 44
                        }
                      }
                    },
                    "span": {
                      "start": 38,
                      "end": 44
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
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
                                              "start": 81,
                                              "end": 86
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "bar"
                                            },
                                            "span": {
                                              "start": 88,
                                              "end": 91
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 81,
                                        "end": 91
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "Variable": "value"
                                      },
                                      "span": {
                                        "start": 94,
                                        "end": 100
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 81,
                                  "end": 100
                                }
                              }
                            },
                            "span": {
                              "start": 81,
                              "end": 101
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [
                        {
                          "name": "value",
                          "type_hint": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "string"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 64,
                                  "end": 70
                                }
                              }
                            },
                            "span": {
                              "start": 64,
                              "end": 70
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
                            "start": 64,
                            "end": 77
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 60,
                        "end": 103
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 22,
                "end": 109
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 111
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 111
  }
}
===php_error===
PHP Fatal error:  Hooked properties cannot be readonly in Standard input code on line 3
