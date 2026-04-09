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
                          "end": 58,
                          "start_line": 3,
                          "start_col": 27
                        }
                      }
                    },
                    "span": {
                      "start": 54,
                      "end": 58,
                      "start_line": 3,
                      "start_col": 27
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 31,
                "end": 60,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 61,
        "start_line": 2,
        "start_col": 0
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
                          "end": 126,
                          "start_line": 6,
                          "start_col": 33
                        }
                      }
                    },
                    "span": {
                      "start": 120,
                      "end": 126,
                      "start_line": 6,
                      "start_col": 33
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 91,
                "end": 128,
                "start_line": 6,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 62,
        "end": 129,
        "start_line": 5,
        "start_col": 0
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
              "end": 155,
              "start_line": 8,
              "start_col": 19
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
                "end": 174,
                "start_line": 8,
                "start_col": 36
              }
            },
            {
              "parts": [
                "Serializable"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 176,
                "end": 189,
                "start_line": 8,
                "start_col": 46
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
                          "end": 222,
                          "start_line": 9,
                          "start_col": 27
                        }
                      }
                    },
                    "span": {
                      "start": 218,
                      "end": 222,
                      "start_line": 9,
                      "start_col": 27
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 195,
                "end": 230,
                "start_line": 9,
                "start_col": 4
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
                          "end": 265,
                          "start_line": 10,
                          "start_col": 33
                        }
                      }
                    },
                    "span": {
                      "start": 259,
                      "end": 265,
                      "start_line": 10,
                      "start_col": 33
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
                            "end": 285,
                            "start_line": 11,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 276,
                        "end": 291,
                        "start_line": 11,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 230,
                "end": 293,
                "start_line": 10,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 130,
        "end": 294,
        "start_line": 8,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 294,
    "start_line": 1,
    "start_col": 0
  }
}
