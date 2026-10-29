===source===
<?php
namespace N1 {
    use A\B as mixed;
}
namespace N2 {
    class mixed {}
    interface Mixed {}
    class A extends mixed {}
    function f(mixed $a, ?mixed $b): mixed { return $a; }
    function h(\mixed $a, namespace\mixed $b) {}
}
===errors 8.0-8.3===
Cannot use A\B as mixed because 'mixed' is a special class name
Cannot use 'mixed' as class name as it is reserved
Cannot use 'Mixed' as class name as it is reserved
Type mixed cannot be marked as nullable since mixed already includes null
Type declaration 'mixed' must be unqualified
Type declaration 'mixed' must be unqualified
===errors >=8.4===
Cannot use A\B as mixed because 'mixed' is a special class name
Cannot use "mixed" as a class name as it is reserved
Cannot use "Mixed" as an interface name as it is reserved
Type mixed cannot be marked as nullable since mixed already includes null
Type declaration 'mixed' must be unqualified
Type declaration 'mixed' must be unqualified
===php_error >=8.0===
PHP Fatal error:  Cannot use A\B as mixed because 'mixed' is a special class name in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N1"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 18
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
                            "A",
                            "B"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 29,
                            "end": 32
                          }
                        },
                        "alias": {
                          "name": "mixed",
                          "span": {
                            "start": 36,
                            "end": 41
                          }
                        },
                        "span": {
                          "start": 29,
                          "end": 41
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 25,
                  "end": 42
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N2"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 55,
              "end": 57
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Class": {
                    "name": {
                      "name": "mixed",
                      "span": {
                        "start": 70,
                        "end": 75
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
                    "attributes": []
                  }
                },
                "span": {
                  "start": 64,
                  "end": 78
                }
              },
              {
                "kind": {
                  "Interface": {
                    "name": {
                      "name": "Mixed",
                      "span": {
                        "start": 93,
                        "end": 98
                      }
                    },
                    "extends": [],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 83,
                  "end": 101
                }
              },
              {
                "kind": {
                  "Class": {
                    "name": {
                      "name": "A",
                      "span": {
                        "start": 112,
                        "end": 113
                      }
                    },
                    "modifiers": {
                      "is_abstract": false,
                      "is_final": false,
                      "is_readonly": false
                    },
                    "extends": {
                      "parts": [
                        "mixed"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 122,
                        "end": 127
                      }
                    },
                    "implements": [],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 106,
                  "end": 130
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "f",
                      "span": {
                        "start": 144,
                        "end": 145
                      }
                    },
                    "params": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 152,
                            "end": 154
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "mixed"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 146,
                                "end": 151
                              }
                            }
                          },
                          "span": {
                            "start": 146,
                            "end": 151
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 146,
                          "end": 154
                        }
                      },
                      {
                        "name": {
                          "name": "b",
                          "span": {
                            "start": 163,
                            "end": 165
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Nullable": {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "mixed"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 157,
                                    "end": 162
                                  }
                                }
                              },
                              "span": {
                                "start": 157,
                                "end": 162
                              }
                            }
                          },
                          "span": {
                            "start": 156,
                            "end": 162
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 156,
                          "end": 165
                        }
                      }
                    ],
                    "body": [
                      {
                        "kind": {
                          "Return": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 183,
                              "end": 185
                            }
                          }
                        },
                        "span": {
                          "start": 176,
                          "end": 186
                        }
                      }
                    ],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "mixed"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 168,
                            "end": 173
                          }
                        }
                      },
                      "span": {
                        "start": 168,
                        "end": 173
                      }
                    },
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 135,
                  "end": 188
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "h",
                      "span": {
                        "start": 202,
                        "end": 203
                      }
                    },
                    "params": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 211,
                            "end": 213
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "mixed"
                              ],
                              "kind": "FullyQualified",
                              "span": {
                                "start": 204,
                                "end": 210
                              }
                            }
                          },
                          "span": {
                            "start": 204,
                            "end": 210
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 204,
                          "end": 213
                        }
                      },
                      {
                        "name": {
                          "name": "b",
                          "span": {
                            "start": 231,
                            "end": 233
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "mixed"
                              ],
                              "kind": "Relative",
                              "span": {
                                "start": 215,
                                "end": 230
                              }
                            }
                          },
                          "span": {
                            "start": 215,
                            "end": 230
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 215,
                          "end": 233
                        }
                      }
                    ],
                    "body": [],
                    "return_type": null,
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 193,
                  "end": 237
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 45,
        "end": 239
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 239
  }
}
