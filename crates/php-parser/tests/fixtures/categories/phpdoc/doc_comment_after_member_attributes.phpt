===source===
<?php
class C {
    #[A]
    /** method */
    public function m() {}
    #[A]
    /** property */
    public $p;
    /** before */
    #[A]
    /** const */
    const K = 1;
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
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 63,
                      "end": 64
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
                    "text": "/** method */",
                    "span": {
                      "start": 29,
                      "end": 42
                    }
                  }
                }
              },
              "span": {
                "start": 47,
                "end": 69
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 110,
                      "end": 112
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** property */",
                    "span": {
                      "start": 83,
                      "end": 98
                    }
                  }
                }
              },
              "span": {
                "start": 103,
                "end": 112
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "K",
                    "span": {
                      "start": 168,
                      "end": 169
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 172,
                      "end": 173
                    }
                  },
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** const */",
                    "span": {
                      "start": 145,
                      "end": 157
                    }
                  }
                }
              },
              "span": {
                "start": 162,
                "end": 174
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 176
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 176
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
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 63,
                      "end": 64
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "A"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 23
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 22,
                        "end": 23
                      }
                    }
                  ],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** method */",
                    "span": {
                      "start": 29,
                      "end": 42
                    }
                  }
                }
              },
              "span": {
                "start": 20,
                "end": 69
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 110,
                      "end": 112
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
                          "start": 76,
                          "end": 77
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 76,
                        "end": 77
                      }
                    }
                  ],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** property */",
                    "span": {
                      "start": 83,
                      "end": 98
                    }
                  }
                }
              },
              "span": {
                "start": 74,
                "end": 112
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "K",
                    "span": {
                      "start": 168,
                      "end": 169
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 172,
                      "end": 173
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "A"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 138,
                          "end": 139
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 138,
                        "end": 139
                      }
                    }
                  ],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** const */",
                    "span": {
                      "start": 145,
                      "end": 157
                    }
                  }
                }
              },
              "span": {
                "start": 136,
                "end": 174
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 176
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 176
  }
}
