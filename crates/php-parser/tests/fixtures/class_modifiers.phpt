===config===
min_php=8.2
===source===
<?php
abstract class Base {
    abstract public function doSomething(): void;
}
final class Sealed {
    public function run(): void {}
}
readonly class Value {
    public function __construct(
        public string $name,
        public int $age,
    ) {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Base",
            "span": {
              "start": 21,
              "end": 25
            }
          },
          "modifiers": {
            "is_abstract": true,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "doSomething",
                    "span": {
                      "start": 57,
                      "end": 68
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
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
                          "start": 72,
                          "end": 76
                        }
                      }
                    },
                    "span": {
                      "start": 72,
                      "end": 76
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 32,
                "end": 77
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 79
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Sealed",
            "span": {
              "start": 92,
              "end": 98
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": true,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "run",
                    "span": {
                      "start": 121,
                      "end": 124
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
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
                          "start": 128,
                          "end": 132
                        }
                      }
                    },
                    "span": {
                      "start": 128,
                      "end": 132
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 105,
                "end": 135
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 86,
        "end": 137
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Value",
            "span": {
              "start": 153,
              "end": 158
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 181,
                      "end": 192
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "name",
                        "span": {
                          "start": 216,
                          "end": 221
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 209,
                              "end": 215
                            }
                          }
                        },
                        "span": {
                          "start": 209,
                          "end": 215
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 202,
                        "end": 221
                      }
                    },
                    {
                      "name": {
                        "name": "age",
                        "span": {
                          "start": 242,
                          "end": 246
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 238,
                              "end": 241
                            }
                          }
                        },
                        "span": {
                          "start": 238,
                          "end": 241
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 231,
                        "end": 246
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 165,
                "end": 256
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 147,
        "end": 258
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 258
  }
}
