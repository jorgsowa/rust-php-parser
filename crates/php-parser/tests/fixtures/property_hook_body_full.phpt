===source===
<?php class A { public string $x { get { return $this->x; } set { $this->x = $value; } } }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "A",
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
                  "name": "x",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 23,
                          "end": 29
                        }
                      }
                    },
                    "span": {
                      "start": 23,
                      "end": 29
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
                                        "start": 48,
                                        "end": 53
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "x"
                                      },
                                      "span": {
                                        "start": 55,
                                        "end": 56
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 48,
                                  "end": 56
                                }
                              }
                            },
                            "span": {
                              "start": 41,
                              "end": 58
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 35,
                        "end": 60
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
                                              "start": 66,
                                              "end": 71
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "x"
                                            },
                                            "span": {
                                              "start": 73,
                                              "end": 74
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 66,
                                        "end": 74
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "Variable": "value"
                                      },
                                      "span": {
                                        "start": 77,
                                        "end": 83
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 66,
                                  "end": 83
                                }
                              }
                            },
                            "span": {
                              "start": 66,
                              "end": 85
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 60,
                        "end": 87
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 89
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 90
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 90
  }
}
