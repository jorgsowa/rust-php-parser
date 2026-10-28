===source===
<?php
class C {
    /** first */ /** second */ const K = 1;
    public function afterConst() {}
    /** before */ #[A] /** after */ public $p;
    public function afterProperty() {}
}
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 12,
              "end": 13
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
                    "name": "K",
                    "span": {
                      "start": 53,
                      "end": 54
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 57,
                      "end": 58
                    }
                  },
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** second */",
                    "span": {
                      "start": 33,
                      "end": 46
                    }
                  }
                }
              },
              "span": {
                "start": 47,
                "end": 59
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "afterConst",
                    "span": {
                      "start": 80,
                      "end": 90
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 64,
                "end": 95
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "afterProperty",
                    "span": {
                      "start": 163,
                      "end": 176
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** before */",
                    "span": {
                      "start": 100,
                      "end": 113
                    }
                  }
                }
              },
              "span": {
                "start": 147,
                "end": 181
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 183
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 183
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 12,
              "end": 13
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
                    "name": "K",
                    "span": {
                      "start": 53,
                      "end": 54
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 57,
                      "end": 58
                    }
                  },
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** second */",
                    "span": {
                      "start": 33,
                      "end": 46
                    }
                  }
                }
              },
              "span": {
                "start": 47,
                "end": 59
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "afterConst",
                    "span": {
                      "start": 80,
                      "end": 90
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 64,
                "end": 95
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 139,
                      "end": 141
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "A"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 116,
                          "end": 117
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 116,
                        "end": 117
                      }
                    }
                  ],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** after */",
                    "span": {
                      "start": 119,
                      "end": 131
                    }
                  }
                }
              },
              "span": {
                "start": 114,
                "end": 141
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "afterProperty",
                    "span": {
                      "start": 163,
                      "end": 176
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 147,
                "end": 181
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 183
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 183
  }
}
