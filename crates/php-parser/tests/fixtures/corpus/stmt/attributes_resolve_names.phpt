===description===
Attribute names resolve like class names: in a namespace an unimported name is not the built-in attribute.
===source===
<?php
namespace A {
    use Foo\Attribute as Local;
    use Foo\Override;

    #[Attribute] function f() {}
    #[Local] function g() {}
    #[Override] class C {}
    #[namespace\Attribute] function h() {}
    #[\A\Attribute] function i() {}
    #[Foo\Attribute] function j() {}
}
===errors <=7.4===
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Normal",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "Foo",
                            "Attribute"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 28,
                            "end": 41
                          }
                        },
                        "alias": {
                          "name": "Local",
                          "span": {
                            "start": 45,
                            "end": 50
                          }
                        },
                        "span": {
                          "start": 28,
                          "end": 50
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 24,
                  "end": 51
                }
              },
              {
                "kind": {
                  "Use": {
                    "kind": "Normal",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "Foo",
                            "Override"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 60,
                            "end": 72
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 60,
                          "end": 72
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 56,
                  "end": 73
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "f",
                      "span": {
                        "start": 101,
                        "end": 102
                      }
                    },
                    "params": [],
                    "body": [],
                    "return_type": null,
                    "by_ref": false,
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "Attribute"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 81,
                            "end": 90
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 81,
                          "end": 90
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 92,
                  "end": 107
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "g",
                      "span": {
                        "start": 130,
                        "end": 131
                      }
                    },
                    "params": [],
                    "body": [],
                    "return_type": null,
                    "by_ref": false,
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "Local"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 114,
                            "end": 119
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 114,
                          "end": 119
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 121,
                  "end": 136
                }
              },
              {
                "kind": {
                  "Class": {
                    "name": {
                      "name": "C",
                      "span": {
                        "start": 159,
                        "end": 160
                      }
                    },
                    "modifiers": {
                      "is_abstract": false,
                      "is_final": false,
                      "is_readonly": false
                    },
                    "extends": null,
                    "implements": [],
                    "members": [],
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "Override"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 143,
                            "end": 151
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 143,
                          "end": 151
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 153,
                  "end": 163
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "h",
                      "span": {
                        "start": 200,
                        "end": 201
                      }
                    },
                    "params": [],
                    "body": [],
                    "return_type": null,
                    "by_ref": false,
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "Attribute"
                          ],
                          "kind": "Relative",
                          "span": {
                            "start": 170,
                            "end": 189
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 170,
                          "end": 189
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 191,
                  "end": 206
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "i",
                      "span": {
                        "start": 236,
                        "end": 237
                      }
                    },
                    "params": [],
                    "body": [],
                    "return_type": null,
                    "by_ref": false,
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "A",
                            "Attribute"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 213,
                            "end": 225
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 213,
                          "end": 225
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 227,
                  "end": 242
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "j",
                      "span": {
                        "start": 273,
                        "end": 274
                      }
                    },
                    "params": [],
                    "body": [],
                    "return_type": null,
                    "by_ref": false,
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "Foo",
                            "Attribute"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 249,
                            "end": 262
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 249,
                          "end": 262
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 264,
                  "end": 279
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 281
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 281
  }
}
