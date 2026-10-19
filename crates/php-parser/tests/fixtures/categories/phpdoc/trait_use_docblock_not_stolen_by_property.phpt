===source===
<?php

class WidgetConfig
{
    /**
     * Applies the widget's default values.
     */
    use SetDefaultValue;

    public string $name = 'widget';
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "WidgetConfig",
            "span": {
              "start": 13,
              "end": 25
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
                        "SetDefaultValue"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 96,
                        "end": 111
                      }
                    }
                  ],
                  "adaptations": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * Applies the widget's default values.\n     */",
                    "span": {
                      "start": 32,
                      "end": 87
                    }
                  }
                }
              },
              "span": {
                "start": 92,
                "end": 112
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "name",
                    "span": {
                      "start": 132,
                      "end": 137
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 125,
                          "end": 131
                        }
                      }
                    },
                    "span": {
                      "start": 125,
                      "end": 131
                    }
                  },
                  "default": {
                    "kind": {
                      "String": "widget"
                    },
                    "span": {
                      "start": 140,
                      "end": 148
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 118,
                "end": 148
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 151
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 151
  }
}
