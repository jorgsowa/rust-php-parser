===config===
min_php=8.4
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
                          "end": 29,
                          "start_line": 1,
                          "start_col": 23
                        }
                      }
                    },
                    "span": {
                      "start": 23,
                      "end": 29,
                      "start_line": 1,
                      "start_col": 23
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
                                        "end": 53,
                                        "start_line": 1,
                                        "start_col": 48
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "x"
                                      },
                                      "span": {
                                        "start": 55,
                                        "end": 56,
                                        "start_line": 1,
                                        "start_col": 55
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 48,
                                  "end": 56,
                                  "start_line": 1,
                                  "start_col": 48
                                }
                              }
                            },
                            "span": {
                              "start": 41,
                              "end": 58,
                              "start_line": 1,
                              "start_col": 41
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
                        "end": 60,
                        "start_line": 1,
                        "start_col": 35
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
                                              "end": 71,
                                              "start_line": 1,
                                              "start_col": 66
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "x"
                                            },
                                            "span": {
                                              "start": 73,
                                              "end": 74,
                                              "start_line": 1,
                                              "start_col": 73
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 66,
                                        "end": 74,
                                        "start_line": 1,
                                        "start_col": 66
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "Variable": "value"
                                      },
                                      "span": {
                                        "start": 77,
                                        "end": 83,
                                        "start_line": 1,
                                        "start_col": 77
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 66,
                                  "end": 83,
                                  "start_line": 1,
                                  "start_col": 66
                                }
                              }
                            },
                            "span": {
                              "start": 66,
                              "end": 85,
                              "start_line": 1,
                              "start_col": 66
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
                        "end": 87,
                        "start_line": 1,
                        "start_col": 60
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 89,
                "start_line": 1,
                "start_col": 16
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 90,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 90,
    "start_line": 1,
    "start_col": 0
  }
}
