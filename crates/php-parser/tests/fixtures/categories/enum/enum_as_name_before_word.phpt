===source===
<?php
echo enum;
echo enum ?? 1;
X::enum and 1;
$x->enum and 1;
class A { use T { enum as foo; T::enum as bar; } }
class B extends enum implements I {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Name": {
                "parts": [
                  "enum"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 11,
                  "end": 15
                }
              }
            },
            "span": {
              "start": 11,
              "end": 15
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 16
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "NullCoalesce": {
                "left": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "enum"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 22,
                        "end": 26
                      }
                    }
                  },
                  "span": {
                    "start": 22,
                    "end": 26
                  }
                },
                "right": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 30,
                    "end": 31
                  }
                }
              }
            },
            "span": {
              "start": 22,
              "end": 31
            }
          }
        ]
      },
      "span": {
        "start": 17,
        "end": 32
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "X"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 33,
                            "end": 34
                          }
                        }
                      },
                      "span": {
                        "start": 33,
                        "end": 34
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "enum"
                      },
                      "span": {
                        "start": 36,
                        "end": 40
                      }
                    }
                  }
                },
                "span": {
                  "start": 33,
                  "end": 40
                }
              },
              "op": "LogicalAnd",
              "right": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 45,
                  "end": 46
                }
              }
            }
          },
          "span": {
            "start": 33,
            "end": 46
          }
        }
      },
      "span": {
        "start": 33,
        "end": 47
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 48,
                        "end": 50
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "enum"
                      },
                      "span": {
                        "start": 52,
                        "end": 56
                      }
                    }
                  }
                },
                "span": {
                  "start": 48,
                  "end": 56
                }
              },
              "op": "LogicalAnd",
              "right": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 61,
                  "end": 62
                }
              }
            }
          },
          "span": {
            "start": 48,
            "end": 62
          }
        }
      },
      "span": {
        "start": 48,
        "end": 63
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 70,
              "end": 71
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
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "T"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 78,
                        "end": 79
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": null,
                          "method": {
                            "parts": [
                              "enum"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 82,
                              "end": 86
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "foo"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 90,
                              "end": 93
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 82,
                        "end": 94
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "T"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 95,
                              "end": 96
                            }
                          },
                          "method": {
                            "parts": [
                              "enum"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 98,
                              "end": 102
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "bar"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 106,
                              "end": 109
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 95,
                        "end": 110
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 74,
                "end": 112
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 64,
        "end": 114
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 121,
              "end": 122
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "enum"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 131,
              "end": 135
            }
          },
          "implements": [
            {
              "parts": [
                "I"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 147,
                "end": 148
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 115,
        "end": 151
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 151
  }
}
