===source===
<?php
class A {
    final private const X = 1;
    private final const Y = 1, Z = 2;
}
interface I {
    final private const X = 1;
}
$o = new class {
    final private const X = 1;
};
===errors >=8.1===
Private constant A::X cannot be final as it is not visible to other classes
Private constant A::Y cannot be final as it is not visible to other classes
Private constant I::X cannot be final as it is not visible to other classes
Access type for interface constant I::X must be public
Private constant class@anonymous::X cannot be final as it is not visible to other classes
===php_error <=8.0===
PHP Fatal error:  Cannot use 'final' as constant modifier in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  Private constant A::X cannot be final as it is not visible to other classes in Standard input code on line 3
===ast >=8.1===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
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
                    "name": "X",
                    "span": {
                      "start": 40,
                      "end": 41
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_final": true
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 44,
                      "end": 45
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 46
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 71,
                      "end": 72
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_final": true
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 75,
                      "end": 76
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 51,
                "end": 84
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Z",
                    "span": {
                      "start": 78,
                      "end": 79
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_final": true
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 82,
                      "end": 83
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 51,
                "end": 84
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 86
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 97,
              "end": 98
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 125,
                      "end": 126
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_final": true
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 129,
                      "end": 130
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 105,
                "end": 131
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 87,
        "end": 133
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 134,
                  "end": 136
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
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
                                    "name": "X",
                                    "span": {
                                      "start": 175,
                                      "end": 176
                                    }
                                  },
                                  "modifiers": {
                                    "visibility": "Private",
                                    "is_final": true
                                  },
                                  "value": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 179,
                                      "end": 180
                                    }
                                  },
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 155,
                                "end": 181
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 139,
                        "end": 183
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 139,
                  "end": 183
                }
              }
            }
          },
          "span": {
            "start": 134,
            "end": 183
          }
        }
      },
      "span": {
        "start": 134,
        "end": 184
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 184
  }
}
