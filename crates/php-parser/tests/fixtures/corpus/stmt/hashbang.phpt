===source===
#!/usr/bin/env php
<?php

echo "foobar";

?>
#!/usr/bin/env php
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "foobar"
            },
            "span": {
              "start": 31,
              "end": 39
            }
          }
        ]
      },
      "span": {
        "start": 26,
        "end": 40
      }
    },
    {
      "kind": {
        "InlineHtml": "\n#!/usr/bin/env php"
      },
      "span": {
        "start": 44,
        "end": 63
      }
    }
  ],
  "span": {
    "start": 19,
    "end": 63
  }
}
