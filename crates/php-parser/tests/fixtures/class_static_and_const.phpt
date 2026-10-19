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
          "name": {
            "name": "Config",
            "span": {
              "start": 12,
              "end": 18
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
                "ClassConst": {
                  "name": {
                    "name": "VERSION",
                    "span": {
                      "start": 38,
                      "end": 45
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "value": {
                    "kind": {
                      "String": "1.0"
                    },
                    "span": {
                      "start": 48,
                      "end": 53
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 25,
                "end": 54
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "DEBUG",
                    "span": {
                      "start": 73,
                      "end": 78
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "value": {
                    "kind": {
                      "Bool": false
                    },
                    "span": {
                      "start": 81,
                      "end": 86
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 59,
                "end": 87
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "count",
                    "span": {
                      "start": 110,
                      "end": 116
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 106,
                          "end": 109
                        }
                      }
                    },
                    "span": {
                      "start": 106,
                      "end": 109
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 119,
                      "end": 120
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 92,
                "end": 120
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "increment",
                    "span": {
                      "start": 149,
                      "end": 158
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
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
                          "end": 166
                        }
                      }
                    },
                    "span": {
                      "start": 162,
                      "end": 166
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
                                        "Name": {
                                          "parts": [
                                            "self"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 177,
                                            "end": 181
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 177,
                                        "end": 181
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "count"
                                      },
                                      "span": {
                                        "start": 183,
                                        "end": 189
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 177,
                                  "end": 189
                                }
                              },
                              "op": "PostIncrement"
                            }
                          },
                          "span": {
                            "start": 177,
                            "end": 191
                          }
                        }
                      },
                      "span": {
                        "start": 177,
                        "end": 192
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 126,
                "end": 198
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 200
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 200
  }
}
