===source===
<?php
class Config {
    public const VERSION = '1.0';
    private const DEBUG = false;
    public static int $count = 0;
    public static function increment(): void {
        self::$count++;
    }
}
===ast===
{
  "stmts": [
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
                  "name": "VERSION",
                  "visibility": "Public",
                  "value": {
                    "kind": {
                      "String": "1.0"
                    },
                    "span": {
                      "start": 48,
                      "end": 53,
                      "start_line": 3,
                      "start_col": 27
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 25,
                "end": 59,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "DEBUG",
                  "visibility": "Private",
                  "value": {
                    "kind": {
                      "Bool": false
                    },
                    "span": {
                      "start": 81,
                      "end": 86,
                      "start_line": 4,
                      "start_col": 26
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 59,
                "end": 92,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "count",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": true,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 106,
                          "end": 109,
                          "start_line": 5,
                          "start_col": 18
                        }
                      }
                    },
                    "span": {
                      "start": 106,
                      "end": 109,
                      "start_line": 5,
                      "start_col": 18
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 119,
                      "end": 120,
                      "start_line": 5,
                      "start_col": 31
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 92,
                "end": 120,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "increment",
                  "visibility": "Public",
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 162,
                          "end": 166,
                          "start_line": 6,
                          "start_col": 40
                        }
                      }
                    },
                    "span": {
                      "start": 162,
                      "end": 166,
                      "start_line": 6,
                      "start_col": 40
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "UnaryPostfix": {
                              "operand": {
                                "kind": {
                                  "StaticPropertyAccess": {
                                    "class": {
                                      "kind": {
                                        "Identifier": "self"
                                      },
                                      "span": {
                                        "start": 177,
                                        "end": 181,
                                        "start_line": 7,
                                        "start_col": 8
                                      }
                                    },
                                    "member": "count"
                                  }
                                },
                                "span": {
                                  "start": 177,
                                  "end": 189,
                                  "start_line": 7,
                                  "start_col": 8
                                }
                              },
                              "op": "PostIncrement"
                            }
                          },
                          "span": {
                            "start": 177,
                            "end": 191,
                            "start_line": 7,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 177,
                        "end": 197,
                        "start_line": 7,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 126,
                "end": 199,
                "start_line": 6,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 200,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 200,
    "start_line": 1,
    "start_col": 0
  }
}
