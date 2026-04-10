===source===
<?php
interface Loggable {
    public function log(): void;
}
interface Serializable {
    public function serialize(): string;
}
class User extends Model implements Loggable, Serializable {
    public function log(): void {}
    public function serialize(): string {
        return '';
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "Loggable",
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "log",
                  "visibility": "Public",
                  "is_static": false,
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
                          "start": 54,
                          "end": 58
                        }
                      }
                    },
                    "span": {
                      "start": 54,
                      "end": 58
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 31,
                "end": 59
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 61
      }
    },
    {
      "kind": {
        "Interface": {
          "name": "Serializable",
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "serialize",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 120,
                          "end": 126
                        }
                      }
                    },
                    "span": {
                      "start": 120,
                      "end": 126
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 91,
                "end": 127
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 62,
        "end": 129
      }
    },
    {
      "kind": {
        "Class": {
          "name": "User",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "Model"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 149,
              "end": 154
            }
          },
          "implements": [
            {
              "parts": [
                "Loggable"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 166,
                "end": 174
              }
            },
            {
              "parts": [
                "Serializable"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 176,
                "end": 188
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "log",
                  "visibility": "Public",
                  "is_static": false,
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
                          "start": 218,
                          "end": 222
                        }
                      }
                    },
                    "span": {
                      "start": 218,
                      "end": 222
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 195,
                "end": 225
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "serialize",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 259,
                          "end": 265
                        }
                      }
                    },
                    "span": {
                      "start": 259,
                      "end": 265
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "String": ""
                          },
                          "span": {
                            "start": 283,
                            "end": 285
                          }
                        }
                      },
                      "span": {
                        "start": 276,
                        "end": 286
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 230,
                "end": 292
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 130,
        "end": 294
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 294
  }
}
