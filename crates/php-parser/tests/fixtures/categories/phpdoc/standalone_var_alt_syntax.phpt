===source===
<?php
// Known limitation: alternative-syntax blocks use no `{` token, so the
// scope-boundary floor never rises when entering the body.  The doc comment
// is therefore claimed by the first statement *inside* the block rather than
// by the `foreach` itself.  Fix would require tracking `:` as a scope
// boundary for alternative-syntax constructs.
/** @var string $item */
foreach ($items as $item):
    echo $item;
endforeach;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "items"
            },
            "span": {
              "start": 385,
              "end": 391
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "item"
            },
            "span": {
              "start": 395,
              "end": 400
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Variable": "item"
                        },
                        "span": {
                          "start": 412,
                          "end": 417
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 407,
                    "end": 418
                  },
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** @var string $item */",
                    "span": {
                      "start": 351,
                      "end": 375
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 376,
              "end": 430
            }
          },
          "uses_alternative": true
        }
      },
      "span": {
        "start": 376,
        "end": 430
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 430
  }
}
