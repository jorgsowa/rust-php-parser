===source===
<?php
while (1) { $o = new class { public $p { get { break; } } }; }
===errors===
Cannot 'break' 1 level
===php_error===
PHP Fatal error:  'break' not in the 'loop' or 'switch' context in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 13,
              "end": 14
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "o"
                            },
                            "span": {
                              "start": 18,
                              "end": 20
                            }
                          },
                          "op": "Assign",
                          "value": {
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
                                      "extends": null,
                                      "implements": [],
                                      "members": [
                                        {
                                          "kind": {
                                            "Property": {
                                              "name": {
                                                "name": "p",
                                                "span": {
                                                  "start": 42,
                                                  "end": 44
                                                }
                                              },
                                              "visibility": "Public",
                                              "set_visibility": null,
                                              "is_static": false,
                                              "is_readonly": false,
                                              "type_hint": null,
                                              "default": null,
                                              "attributes": [],
                                              "hooks": [
                                                {
                                                  "kind": "Get",
                                                  "body": {
                                                    "Block": [
                                                      {
                                                        "kind": {
                                                          "Break": null
                                                        },
                                                        "span": {
                                                          "start": 53,
                                                          "end": 59
                                                        }
                                                      }
                                                    ]
                                                  },
                                                  "is_final": false,
                                                  "by_ref": false,
                                                  "params": [],
                                                  "attributes": [],
                                                  "span": {
                                                    "start": 47,
                                                    "end": 61
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 35,
                                            "end": 63
                                          }
                                        }
                                      ],
                                      "attributes": []
                                    }
                                  },
                                  "span": {
                                    "start": 23,
                                    "end": 65
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 23,
                              "end": 65
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 18,
                        "end": 65
                      }
                    }
                  },
                  "span": {
                    "start": 18,
                    "end": 66
                  }
                }
              ]
            },
            "span": {
              "start": 16,
              "end": 68
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 68
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
  }
}
