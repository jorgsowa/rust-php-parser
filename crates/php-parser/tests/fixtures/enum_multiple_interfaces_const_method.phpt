===config===
min_php=8.1
===source===
<?php
enum Status: string implements Loggable, Serializable {
    case Active = 'active';
    case Inactive = 'inactive';

    const DEFAULT = self::Active;

    public function label(): string {
        return $this->value;
    }

    public function isActive(): bool {
        return $this === self::Active;
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Status",
          "scalar_type": {
            "parts": [
              "string"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 19,
              "end": 26,
              "start_line": 2,
              "start_col": 13
            }
          },
          "implements": [
            {
              "parts": [
                "Loggable"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 37,
                "end": 45,
                "start_line": 2,
                "start_col": 31
              }
            },
            {
              "parts": [
                "Serializable"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 47,
                "end": 60,
                "start_line": 2,
                "start_col": 41
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "Active",
                  "value": {
                    "kind": {
                      "String": "active"
                    },
                    "span": {
                      "start": 80,
                      "end": 88,
                      "start_line": 3,
                      "start_col": 18
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 66,
                "end": 94,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Inactive",
                  "value": {
                    "kind": {
                      "String": "inactive"
                    },
                    "span": {
                      "start": 110,
                      "end": 120,
                      "start_line": 4,
                      "start_col": 20
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 94,
                "end": 127,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "DEFAULT",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Identifier": "self"
                          },
                          "span": {
                            "start": 143,
                            "end": 147,
                            "start_line": 6,
                            "start_col": 20
                          }
                        },
                        "member": "Active"
                      }
                    },
                    "span": {
                      "start": 143,
                      "end": 155,
                      "start_line": 6,
                      "start_col": 20
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 127,
                "end": 162,
                "start_line": 6,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "label",
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
                          "start": 187,
                          "end": 193,
                          "start_line": 8,
                          "start_col": 29
                        }
                      }
                    },
                    "span": {
                      "start": 187,
                      "end": 193,
                      "start_line": 8,
                      "start_col": 29
                    }
                  },
                  "body": [
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
                                  "start": 211,
                                  "end": 216,
                                  "start_line": 9,
                                  "start_col": 15
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "value"
                                },
                                "span": {
                                  "start": 218,
                                  "end": 223,
                                  "start_line": 9,
                                  "start_col": 22
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 211,
                            "end": 223,
                            "start_line": 9,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 204,
                        "end": 229,
                        "start_line": 9,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 162,
                "end": 236,
                "start_line": 8,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "isActive",
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
                          "bool"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 264,
                          "end": 268,
                          "start_line": 12,
                          "start_col": 32
                        }
                      }
                    },
                    "span": {
                      "start": 264,
                      "end": 268,
                      "start_line": 12,
                      "start_col": 32
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 286,
                                  "end": 291,
                                  "start_line": 13,
                                  "start_col": 15
                                }
                              },
                              "op": "Identical",
                              "right": {
                                "kind": {
                                  "ClassConstAccess": {
                                    "class": {
                                      "kind": {
                                        "Identifier": "self"
                                      },
                                      "span": {
                                        "start": 296,
                                        "end": 300,
                                        "start_line": 13,
                                        "start_col": 25
                                      }
                                    },
                                    "member": "Active"
                                  }
                                },
                                "span": {
                                  "start": 296,
                                  "end": 308,
                                  "start_line": 13,
                                  "start_col": 25
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 286,
                            "end": 308,
                            "start_line": 13,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 279,
                        "end": 314,
                        "start_line": 13,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 236,
                "end": 316,
                "start_line": 12,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 317,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 317,
    "start_line": 1,
    "start_col": 0
  }
}
