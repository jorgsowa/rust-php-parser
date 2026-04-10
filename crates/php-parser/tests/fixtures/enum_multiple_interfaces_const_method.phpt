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
              "end": 25
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
                "end": 45
              }
            },
            {
              "parts": [
                "Serializable"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 47,
                "end": 59
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
                      "end": 88
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 66,
                "end": 89
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
                      "end": 120
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 94,
                "end": 121
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
                            "end": 147
                          }
                        },
                        "member": "Active"
                      }
                    },
                    "span": {
                      "start": 143,
                      "end": 155
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 127,
                "end": 156
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
                          "end": 193
                        }
                      }
                    },
                    "span": {
                      "start": 187,
                      "end": 193
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
                                  "end": 216
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "value"
                                },
                                "span": {
                                  "start": 218,
                                  "end": 223
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 211,
                            "end": 223
                          }
                        }
                      },
                      "span": {
                        "start": 204,
                        "end": 224
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 162,
                "end": 230
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
                          "end": 268
                        }
                      }
                    },
                    "span": {
                      "start": 264,
                      "end": 268
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
                                  "end": 291
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
                                        "end": 300
                                      }
                                    },
                                    "member": "Active"
                                  }
                                },
                                "span": {
                                  "start": 296,
                                  "end": 308
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 286,
                            "end": 308
                          }
                        }
                      },
                      "span": {
                        "start": 279,
                        "end": 309
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 236,
                "end": 315
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 317
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 317
  }
}
