===source===
<?php
class Point {
    public readonly float $x;
    public readonly float $y;
    public function __construct(float $x, float $y) {
        $this->x = $x;
        $this->y = $y;
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Point",
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
                  "is_readonly": true,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "float"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 40,
                          "end": 45,
                          "start_line": 3,
                          "start_col": 20
                        }
                      }
                    },
                    "span": {
                      "start": 40,
                      "end": 45,
                      "start_line": 3,
                      "start_col": 20
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 48,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "y",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": true,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "float"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 70,
                          "end": 75,
                          "start_line": 4,
                          "start_col": 20
                        }
                      }
                    },
                    "span": {
                      "start": 70,
                      "end": 75,
                      "start_line": 4,
                      "start_col": 20
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 54,
                "end": 78,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "__construct",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "x",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "float"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 112,
                              "end": 117,
                              "start_line": 5,
                              "start_col": 32
                            }
                          }
                        },
                        "span": {
                          "start": 112,
                          "end": 117,
                          "start_line": 5,
                          "start_col": 32
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
                        "start": 112,
                        "end": 120,
                        "start_line": 5,
                        "start_col": 32
                      }
                    },
                    {
                      "name": "y",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "float"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 122,
                              "end": 127,
                              "start_line": 5,
                              "start_col": 42
                            }
                          }
                        },
                        "span": {
                          "start": 122,
                          "end": 127,
                          "start_line": 5,
                          "start_col": 42
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
                        "start": 122,
                        "end": 130,
                        "start_line": 5,
                        "start_col": 42
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
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
                                        "start": 142,
                                        "end": 147,
                                        "start_line": 6,
                                        "start_col": 8
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "x"
                                      },
                                      "span": {
                                        "start": 149,
                                        "end": 150,
                                        "start_line": 6,
                                        "start_col": 15
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 142,
                                  "end": 150,
                                  "start_line": 6,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "x"
                                },
                                "span": {
                                  "start": 153,
                                  "end": 155,
                                  "start_line": 6,
                                  "start_col": 19
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 142,
                            "end": 155,
                            "start_line": 6,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 142,
                        "end": 165,
                        "start_line": 6,
                        "start_col": 8
                      }
                    },
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
                                        "start": 165,
                                        "end": 170,
                                        "start_line": 7,
                                        "start_col": 8
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "y"
                                      },
                                      "span": {
                                        "start": 172,
                                        "end": 173,
                                        "start_line": 7,
                                        "start_col": 15
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 165,
                                  "end": 173,
                                  "start_line": 7,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "y"
                                },
                                "span": {
                                  "start": 176,
                                  "end": 178,
                                  "start_line": 7,
                                  "start_col": 19
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 165,
                            "end": 178,
                            "start_line": 7,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 165,
                        "end": 184,
                        "start_line": 7,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 84,
                "end": 186,
                "start_line": 5,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 187,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 187,
    "start_line": 1,
    "start_col": 0
  }
}
